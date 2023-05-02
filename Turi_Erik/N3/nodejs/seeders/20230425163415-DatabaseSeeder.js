'use strict';

const { faker } = require('@faker-js/faker')
const { User, Post, Category } = require('../models')
const _ = require('lodash')
 
/** @type {import('sequelize-cli').Migration} */
module.exports = {
  async up (queryInterface, Sequelize) {
    let users = []
    for (let i = 0; i < 10; i++){
      users.push(await User.create({
        name: faker.name.fullName(),
        email: faker.helpers.unique(faker.internet.email),
        password: 'TODO',
        isAdmin: Math.random() < 0.2
      }))
    }

    let posts = []
    for (let i = 0; i < 10; i++){
      posts.push(await Post.create({
        title: faker.lorem.sentence(),
        content: faker.lorem.text(),
        published: Math.random() < 0.8,
        // authorId: users[Math.floor(Math.random() * users.length)].id
        // authorId: _.sample(users).id
        authorId: faker.helpers.arrayElement(users).id
      }))
    }

    for (let i = 0; i < 10; i++){
      let c = await Category.create({
        name: faker.lorem.word(),
        color: faker.internet.color()
      })
      await c.setPosts(faker.helpers.arrayElements(posts))
    }
  },

  async down (queryInterface, Sequelize) {

  }
};
