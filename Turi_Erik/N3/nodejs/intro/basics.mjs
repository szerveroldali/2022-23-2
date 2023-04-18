let x = 3
const obj = {a : 4}
obj.a = 5
obj.b = 6
console.log(obj)
let array = [1, 2, 3, 4, 5]
console.log(array.filter(x => x % 2 == 0))
console.log(array.map(x => x ** 3))

const add = (a, b) => {
    return a + b
}

import chalk from "chalk"

console.log(chalk.blue('Helló kéken irok.'))