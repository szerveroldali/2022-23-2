const prompt = require('prompt-sync')()

let name = prompt("Mi a neved?")
console.log(`Szia, ${name}`)

let x = 3
const obj = {
    a : 4
}
obj.a = 5
//obj = {a : 5}
obj.b = 6
console.log(obj)
let array = [1, 2, 3, 4]
console.log(array)
console.log(array.filter(x => x % 2 === 0))
console.log(array.map(x => x ** 3))
console.log(array.map(x => {
    return x ** 3
}))