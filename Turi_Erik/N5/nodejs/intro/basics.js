let x = 3
console.log(x)

const obj = {a : 4}
obj.a = 5
obj.b = 6
console.log(obj)

let array = [5, 6, 9, 2]
console.log( array.filter(x => x % 2 === 0) )
console.log( array.map(x => x ** 0.5) )

for (const key in obj)   
    console.log(key)

for (const value of array)   
    console.log(value)

for (const value of Object.values(obj))   
    console.log(value)