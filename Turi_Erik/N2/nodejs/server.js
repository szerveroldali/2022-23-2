const { User, Post, Category } = require("./models");
const fastify = require("fastify")({ logger: true });
const { Op } = require("sequelize");

fastify.get("/hello", async (request, reply) => {
  reply.send("Hello neked is 4!");
});

fastify.get("/categories", async (request, reply) => {
  reply.send(await Category.findAll());
});

fastify.get(
  "/categories/:id",
  {
    schema: {
      params: {
        id: {
          type: "integer",
        },
      },
    },
  },
  async (request, reply) => {
    const cat = await Category.findByPk(request.params.id);
    if (cat === null) return reply.status(404).send("NOT FOUND");
    reply.send(cat);
  }
);

fastify.post(
  "/categories",
  {
    schema: {
      body: {
        type: "object",
        required: ["name", "color"],
        properties: {
          name: { type: "string" },
          color: { type: "string" },
        },
      },
    },
  },
  async (request, reply) => {
    reply.status(201).send(await Category.create(request.body));
  }
);

fastify.put(
  "/categories/:id",
  {
    schema: {
      body: {
        type: "object",
        required: ["name", "color"],
        properties: {
          name: { type: "string" },
          color: { type: "string" },
        },
      },
      params: {
        id: { type: "integer" },
      },
    },
  },
  async (request, reply) => {
    const cat = await Category.findByPk(request.params.id);
    if (cat === null) return reply.status(404).send("NOT FOUND");
    reply.status(200).send(await cat.update(request.body));
  }
);

fastify.patch(
  "/categories/:id",
  {
    schema: {
      body: {
        type: "object",
        //required: ['name', 'color'],
        properties: {
          name: { type: "string" },
          color: { type: "string" },
        },
      },
      params: {
        id: { type: "integer" },
      },
    },
  },
  async (request, reply) => {
    const cat = await Category.findByPk(request.params.id);
    if (cat === null) return reply.status(404).send("NOT FOUND");
    reply.status(200).send(await cat.update(request.body));
  }
);

fastify.delete(
  "/categories/:id",
  {
    schema: {
      params: {
        id: {
          type: "integer",
        },
      },
    },
  },
  async (request, reply) => {
    const cat = await Category.findByPk(request.params.id);
    if (cat === null) return reply.status(404).send("NOT FOUND");
    await cat.destroy();
    reply.send("DELETED");
  }
);

fastify.delete("/categories", async (request, reply) => {
  await Category.destroy({ truncate: true });
  // await Category.destroy( { where: {} })
  reply.send("DELETED");
});

fastify.get("/unpublished", async (request, reply) => {
  reply.send(await Post.findAll({ where: { published: false } }));
});

fastify.get("/developers", async (request, reply) => {
  reply.send(
    await User.findAll({
      where: {
        id: {
          [Op.lt]: 5,
        },
      },
    })
  );
});

fastify.get("/developers-2", async (request, reply) => {
  reply.send(
    await User.findAll({
      where: {
        id: {
          [Op.lt]: 5,
          [Op.gt]: 2,
        },
      },
    })
  );
});

fastify.get("/developers-3", async (request, reply) => {
  reply.send(
    await User.findAll({
      where: {
        id: {
          [Op.or]: [
            { [Op.like]: "%0" },
            { [Op.like]: "%2" },
            { [Op.like]: "%4" },
            { [Op.like]: "%6" },
            { [Op.like]: "%8" },
          ],
        },
      },
      order: [["id", "DESC"]],
    })
  );

  // reply.send( (await User.findAll()).filter(u => u.id % 2 === 0).sort((a, b) => b.id - a.id ))
});

fastify.get("/posts-without-time", async (request, reply) => {
  // reply.send(await Post.findAll( { attributes: ['id', 'title', 'content', 'published', 'authorId'] } ) );
  // ez is azt csinálja, de csalás :)

  reply.send(
    await Post.findAll({ attributes: { exclude: ["createdAt", "updatedAt"] } })
  );
});

fastify.get("/posts-with-categories", async (request, reply) => {
  reply.send(await Post.findAll({ include: Category }));
});

fastify.get("/posts-with-categories-2", async (request, reply) => {
  reply.send(
    await Post.findAll({
      include: { model: Category, through: { attributes: [] } },
    })
  );
});

fastify.get("/posts-with-everything", async (request, reply) => {
  reply.send(
    await Post.findAll({
      include: [User, { model: Category, through: { attributes: [] } }],
    })
  );
});

fastify.get(
  "/categories/:id/posts",
  {
    schema: {
      params: {
        id: {
          type: "integer",
        },
      },
    },
  },
  async (request, reply) => {
    const cat = await Category.findByPk(request.params.id);
    if (cat === null) return reply.status(404).send("NOT FOUND");
    reply.send(await cat.getPosts());
  }
);

fastify.register(require("@fastify/jwt"), {
  secret: "supersecret",
});

fastify.decorate("auth", async function (request, reply) {
  try {
    await request.jwtVerify();
  } catch (err) {
    reply.send(err);
  }
});

fastify.post(
  "/login",
  {
    schema: {
      body: {
        type: "object",
        required: ["email"],
        properties: {
          email: { type: "string" },
        },
      },
    },
  },
  async (request, reply) => {
    const user = await User.findOne({ where: { email: request.body.email } });
    if (!user) return reply.status(404).send();
    reply.send({ token: fastify.jwt.sign(user.toJSON()) });
  }
);

fastify.get(
  "/my-posts",
  { onRequest: [fastify.auth] },
  async (request, reply) => {
    const user = await User.findOne({ where: { id: request.user.id } });
    if (!user) return reply.status(404).send();
    reply.send(await user.getPosts());
  }
);

fastify.listen({ port: 4000 }, (err, address) => {
  if (err) throw err;
});
