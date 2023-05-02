const { User, Post, Category } = require('./models')
const fastify = require('fastify')(
    { logger: true }
)

fastify.get('/hello', async (request, reply) => {
    reply.send("Hello neked is 4!")
})

fastify.get('/categories', async (request, reply) => {
    reply.send(await Category.findAll())
})

fastify.get('/categories/:id', {
    schema: {
        params: {
            id: {
                type: 'integer'
            }
        }
    }
} , async (request, reply) => {
    const cat = await Category.findByPk(request.params.id)
    if (cat === null)
        return reply.status(404).send("NOT FOUND")
    reply.send(cat)
})

fastify.post('/categories', {
    schema: {
        body: {
            type: 'object',
            required: ['name', 'color'],
            properties: {
                name: { type: 'string' },
                color: { type: 'string' }
            }
        }
    }
}, async (request, reply) => {
    reply.status(201).send(await Category.create(request.body))
})

fastify.put('/categories/:id', {
    schema: {
        body: {
            type: 'object',
            required: ['name', 'color'],
            properties: {
                name: { type: 'string' },
                color: { type: 'string' }
            }
        },
        params: {
            id: {type: 'integer'}
        }
    }
}, async (request, reply) => {
    const cat = await Category.findByPk(request.params.id)
    if (cat === null)
        return reply.status(404).send("NOT FOUND")
    reply.status(200).send(await cat.update(request.body))
})

fastify.patch('/categories/:id', {
    schema: {
        body: {
            type: 'object',
            //required: ['name', 'color'],
            properties: {
                name: { type: 'string' },
                color: { type: 'string' }
            }
        },
        params: {
            id: {type: 'integer'}
        }
    }
}, async (request, reply) => {
    const cat = await Category.findByPk(request.params.id)
    if (cat === null)
        return reply.status(404).send("NOT FOUND")
    reply.status(200).send(await cat.update(request.body))
})

fastify.delete('/categories/:id', {
    schema: {
        params: {
            id: {
                type: 'integer'
            }
        }
    }
} , async (request, reply) => {
    const cat = await Category.findByPk(request.params.id)
    if (cat === null)
        return reply.status(404).send("NOT FOUND")
    await cat.destroy()
    reply.send("DELETED")
})

fastify.delete('/categories', async (request, reply) => {
    await Category.destroy( { truncate: true })
    // await Category.destroy( { where: {} })
    reply.send("DELETED")
})

fastify.listen({ port: 4000 }, (err, address) => {
    if (err) throw err
})