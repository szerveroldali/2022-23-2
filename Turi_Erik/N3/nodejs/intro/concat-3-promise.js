const { readdir: readDir, readFile, writeFile } = require('fs/promises')

readDir('./intro/files')
.then(names =>
    Promise.all(names.map(name => readFile(`./intro/files/${name}`, { encoding: 'utf-8' })))
)
.then(files => writeFile('./intro/concat.txt', files.join('\n')))
.then(() => console.log('Vége.') )