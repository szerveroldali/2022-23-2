const { User, Post, Category } = require("./models");
const fastify = require("fastify")({ logger: true });

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
    if (cat === null) return reply.status(404).send();
    reply.send(cat);
  }
);

fastify.post(
  "/categories",
  {
    schema: {
      body: {
        type: "object",
        properties: {
          name: { type: "string" },
          color: { type: "string" },
        },
        required: ["name", "color"],
      },
    },
  },
  async (request, reply) => {
    reply.send(await Category.create(request.body));
  }
);

fastify.put(
  "/categories/:id",
  {
    schema: {
      params: {
        id: {
          type: "integer",
        },
      },
      body: {
        type: "object",
        properties: {
          name: { type: "string" },
          color: { type: "string" },
        },
        required: ["name", "color"],
      },
    },
  },
  async (request, reply) => {
    const cat = await Category.findByPk(request.params.id);
    if (cat === null) return reply.status(404).send();
    reply.send(await cat.update(request.body));
  }
);

fastify.patch(
  "/categories/:id",
  {
    schema: {
      params: {
        id: {
          type: "integer",
        },
      },
      body: {
        type: "object",
        properties: {
          name: { type: "string" },
          color: { type: "string" },
        },
        // required: ['name', 'color']
      },
    },
  },
  async (request, reply) => {
    const cat = await Category.findByPk(request.params.id);
    if (cat === null) return reply.status(404).send();
    reply.send(await cat.update(request.body));
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
    if (cat === null) return reply.status(404).send();
    await cat.destroy();
    reply.send("DELETED");
  }
);

fastify.delete("/categories", async (request, reply) => {
  // await Category.destroy( { where: {} } )
  await Category.destroy({ truncate: true });
  reply.send("DELETED");
});

fastify.get("/unpublished", async (request, reply) => {
  reply.send(
    await Post.findAll({
      where: {
        published: false,
      },
    })
  );
});

const { Op } = require("sequelize");

fastify.get("/early-1", async (request, reply) => {
  reply.send(
    await Post.findAll({
      where: {
        id: { [Op.lt]: 5 },
      },
    })
  );
});

fastify.get("/early-2", async (request, reply) => {
  reply.send(
    await Post.findAll({
      where: {
        id: { [Op.lt]: 5, [Op.gt]: 2 },
      },
    })
  );
});

fastify.get("/early-3", async (request, reply) => {
  reply.send(
    await Post.findAll({
      where: {
        id: { [Op.or]: [{ [Op.lt]: 3 }, { [Op.gt]: 6 }] },
      },
      order: [["id", "DESC"]],
    })
  );
  // reply.send( (await Post.findAll()).filter(p => p.id < 3 || p.id > 6).sort((a,b) => b.id - a.id )  )
});

fastify.get("/posts-without-time", async (request, reply) => {
  // reply.send(await Post.findAll( { attributes: ['id', 'title', 'content', 'published', 'authorId'] } ))
  // ez is jó, de kicsit csalás :)
  reply.send(
    await Post.findAll({ attributes: { exclude: ["createdAt", "updatedAt"] } })
  );
});

fastify.get("/posts-with-user", async (request, reply) => {
  reply.send(await Post.findAll({ include: User }));
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
    if (cat === null) return reply.status(404).send();
    reply.send(await cat.getPosts());
  }
);

fastify.register(require("@fastify/jwt"), {
  secret: "supersecret",
  sign: {
    expiresIn: "5m",
  },
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
    const user = await User.findByPk(request.user.id);
    if (!user) return reply.status(404).send();
    reply.send(await user.getPosts());
  }
);

const mercurius = require("mercurius");
const { readFileSync } = require("fs");

const schema = readFileSync("./graphql/schema.gql").toString();

const resolvers = require("./graphql/resolvers");

fastify.register(mercurius, {
  schema,
  resolvers,
  graphiql: true,
});

fastify.listen({ port: 4000 }, (err, address) => {
  if (err) throw err;
});
