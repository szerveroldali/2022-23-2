const { readdir: readDir, readFile, writeFile } = require('fs/promises')

// IIFE = immediately invoked function expression
;(async () => {
    const names = await readDir('./intro/files')
    const output = []
    for (const name of names){
        const file = await readFile(`./intro/files/${name}`, {encoding: 'utf-8'})
        output.push(file)
    }
    await writeFile('./intro/concat.txt', output.join('\n'))
    console.log('Vége.')
})()