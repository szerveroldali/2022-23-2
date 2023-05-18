"use strict";

// Faker dokumentáció, API referencia: https://fakerjs.dev/guide/#node-js
const { faker } = require("@faker-js/faker");
const chalk = require("chalk");
// TODO: Importáld be a modelleket
const { User, Category, Post } = require("../models");

module.exports = {
    up: async (queryInterface, Sequelize) => {
        // TODO: Ide dolgozd ki a seeder tartalmát:

        const usersCount = faker.datatype.number({ min: 3, max: 5 });
        const users = [];

        for (let i = 0; i < usersCount; i++) {
            // const firstName = faker.name.firstName();
            // const lastName = faker.name.lastName();

            users.push(
                await User.create({
                    name: `User ${i+1}`,
                    email: `u${i+1}@szo.hu`,
                    // name: faker.name.fullName(),
                    // name: `${firstName} ${lastName}`,
                    // email: faker.internet.email({ firstName, lastName }),
                    // email: faker.helpers.unique(
                    //     faker.internet.email,
                    //     { firstName, lastName },
                    // ),
                    password: 'password',
                })
            )
        }

        const postsCount = faker.datatype.number({ min: 6, max: 12 });
        const posts = [];

        for (let i = 0; i < postsCount; i++) {
            const user = faker.helpers.arrayElement(users);

            posts.push(
                await user.createPost({
                    title: faker.lorem.sentence().slice(0,-1),
                    text: faker.lorem.paragraphs(),
                })
            )

            // posts.push(
            //     await Post.create({
            //         title: faker.lorem.sentence().slice(0,-1),
            //         text: faker.lorem.paragraphs(),
            //         AuthorId: faker.helpers.arrayElement(users).id,
            //     })
            // )
        }

        // console.log(await users[0].getPosts());

        const categoriesCount = faker.datatype.number({ min: 6, max: 12 });
        const categories = [];

        for (let i = 0; i < categoriesCount; i++) {
            categories.push(
                await Category.create({
                    name: faker.helpers.unique(faker.lorem.word),
                    color: faker.color.human(),
                })
            )
        }

        // N-M
        for (const post of posts) {
            await post.setCategories(
                // random kategóriák
                faker.helpers.arrayElements(categories)
            );
        }

        console.log(chalk.green("A DatabaseSeeder lefutott"));
    },

    // Erre alapvetően nincs szükséged, mivel a parancsok úgy vannak felépítve,
    // hogy tiszta adatbázist generálnak, vagyis a korábbi adatok enélkül is elvesznek
    down: async (queryInterface, Sequelize) => {},
};
