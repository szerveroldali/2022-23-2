const { Category, Post, User } = require("./../models");

// resolver fv: async (parent, params, context, info)

module.exports = {
  Query: {
    hello: async (_, { name }) => `hello ${name || "world"}`,
    add: async (_, { x, y }) => x + y,
    categories: async () => await Category.findAll(),
    category: async (_, { id }) => await Category.findByPk(id),
    statistics: async () => {
      return {
        userCount: await User.count(),
        postPerUser: (await Post.count()) / (await User.count()),
      };
    },
  },
  Mutation: {
    createCategory: async (_, { name, color }) =>
      await Category.create({ name, color }),
    createCategory2: async (_, { input }) => await Category.create(input),
    createPost: async (_, { input, catNames }) => {
      const p = await Post.create(input);
      if (!p) return null;
      for (const cn of catNames) {
        let c = await Category.findOne({ where: { name: cn } });
        if (!c) c = await Category.create({ name: cn, color: "#aaaaaa" });
        await c.addPost(p);
      }
      return p;
    },
  },
  Category: {
    posts: async (cat) => await cat.getPosts(),
  },
  Post: {
    categories: async (post) => await post.getCategories(),
  },
};
