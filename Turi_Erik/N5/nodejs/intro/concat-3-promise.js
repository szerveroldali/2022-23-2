const { readdir: readDir, readFile, writeFile, readdir } = require('fs/promises')

readDir('./intro/files')
    .then(names => Promise.all(names.map(name => readFile(`./intro/files/${name}`, {encoding: 'utf-8'}))))
    .then(output => writeFile('./intro/concat.txt', output.join('\n')))
    .then(() => console.log('Vége.') )
