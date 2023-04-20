const { readdirSync: readDirSync, readFileSync, writeFileSync } = require('fs')

const names = readDirSync('./intro/files')
let output = []
for (const name of names){
    const file = readFileSync(`./intro/files/${name}`, { encoding: 'utf-8' })
    output.push(file)
}
writeFileSync('./intro/concat.txt', output.join('\n'))
console.log('Vége.')