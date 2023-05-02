const { User, Post, Category } = require('./models')
const fastify = require('fastify')(
    { logger: true }
)

fastify.get('/hello', async (request, reply) => {
    reply.send("Hello neked is 2!")
})

fastify.get('/categories', async (request, reply) =>{
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
}, async (request, reply) =>{
    const cat = await Category.findByPk(request.params.id)
    if (cat === null)
        return reply.status(404).send()
    reply.send(cat)
})

fastify.post('/categories', {
    schema: {
        body: {
            type: 'object',
            properties: {
                name: {type: 'string'},
                color: {type: 'string'}
            },
            required: ['name', 'color']
        }
    }
}, async (request, reply) => {
    reply.status(201).send(await Category.create(request.body))
})

fastify.put('/categories/:id', {
    schema: {
        body: {
            type: 'object',
            properties: {
                name: {type: 'string'},
                color: {type: 'string'}
            },
            required: ['name', 'color']
        },
        params: {
            id: { type: 'integer'}
        }
    }
}, async (request, reply) => {
    const cat = await Category.findByPk(request.params.id)
    if (cat === null)
        return reply.status(404).send()
    reply.send(await cat.update(request.body))
})

fastify.patch('/categories/:id', {
    schema: {
        body: {
            type: 'object',
            properties: {
                name: {type: 'string'},
                color: {type: 'string'}
            },
            // required: ['name', 'color']
        },
        params: {
            id: { type: 'integer'}
        }
    }
}, async (request, reply) => {
    const cat = await Category.findByPk(request.params.id)
    if (cat === null)
        return reply.status(404).send()
    reply.send(await cat.update(request.body))
})

fastify.delete('/categories/:id', {
    schema: {
        params: {
            id: {
                type: 'integer'
            }
        }
    }
}, async (request, reply) =>{
    const cat = await Category.findByPk(request.params.id)
    if (cat === null)
        return reply.status(404).send()
    await cat.destroy()
    reply.send("DELETED")
})

fastify.delete('/categories', async (request, reply) => {
    // await Category.destroy( { where: {} } )
    await Category.destroy( { truncate: true } )
    reply.send("DELETED")
})

fastify.get('/categories/:id/posts', {
    schema: {
        params: {
            id: {
                type: 'integer'
            }
        }
    }
}, async (request, reply) =>{
    const cat = await Category.findByPk(request.params.id)
    if (cat === null)
        return reply.status(404).send()
    reply.send(await cat.getPosts())
})

fastify.listen( { port: 4000 } ,  (err, address) => {
    if (err) throw err
})