// resolver függvény: async (parent, input, context, info)
const { Category, Post, User } = require("./../models");

module.exports = {
  Query: {
    hello: async (_, { name }) => `hello ${name || "world"}`,
    isEven: async (_, { x }) => x % 2 === 0,
    categories: async () => await Category.findAll(),
    categoryById: async (_, { id }) => await Category.findByPk(id),
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
    createPost: async (_, { input, cats }) => {
      const p = await Post.create(input);
      if (!p) return null;
      for (const cat of cats) {
        let c = await Category.findOne({ where: { name: cat } });
        if (!c) {
          c = await Category.create({ name: cat, color: "#ffffff" });
        }
        await c.addPost(p);
      }
      return p;
    },
  },
  Category: {
    posts: async (category) => await category.getPosts(),
  },
  Post: {
    categories: async (post) => await post.getCategories(),
    user: async (post) => await post.getUser(),
  },
};
