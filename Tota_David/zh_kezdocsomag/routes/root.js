const { StatusCodes } = require("http-status-codes");
const S = require("fluent-json-schema");
const db = require("../models");
const { Sequelize, sequelize } = db;
const { ValidationError, DatabaseError, Op } = Sequelize;
// TODO: Importáld a modelleket
const { User, Category, Post } = db;

module.exports = function (fastify, opts, next) {
    // http://127.0.0.1:4000/
    fastify.get("/", async (request, reply) => {
        reply.send({ message: "Gyökér végpont" });

        // NOTE: A send alapból 200 OK állapotkódot küld, vagyis az előző sor ugyanaz, mint a következő:
        // reply.status(200).send({ message: "Gyökér végpont" });

        // A 200 helyett használhatsz StatusCodes.OK-ot is (így szemantikusabb):
        // reply.status(StatusCodes.OK).send({ message: "Gyökér végpont" });
    });

    // http://127.0.0.1:4000/auth-protected
    fastify.get("/auth-protected", { onRequest: [fastify.auth] }, async (request, reply) => {
        reply.send({ user: request.user });
    });

    fastify.get('/categories', async (request, reply) => {
        reply.send(await Category.findAll());
    });

    fastify.get(
        '/categories/:id',
        {
            schema: {
                params: S.object().prop('id', S.integer())
            },
        },
        // {
        //     schema: {
        //         params: {
        //             id: {
        //                 type: 'integer',
        //             }
        //         }
        //     },
        // },
        async (request, reply) => {
            // console.log(request.params);

            const category = await Category.findByPk(request.params.id);

            if (!category) {
                return reply.status(404).send();
            }

            reply.send(category);
        }
    );

    next();
};

module.exports.autoPrefix = "/";
