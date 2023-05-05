const { readFile } = require('fs/promises');

// console.log(readFile('./input.txt'))

// readFile('./input.txt').then(content => {
//     console.log(content.toString());
// });

// readFile('./input.txt', 'utf-8')
//     .then(content => {
//         console.log(content);
//     })
//     .catch(error => {
//         console.log(error);
//     })

// const testPromise = new Promise(
//     (resolve, reject) => {
//         setTimeout(
//             () => {
//                 // resolve('222');
//                 reject('message')
//             },
//             1000,
//         )
//     }
// );

// testPromise
//     .then(result => console.log(result))
//     .catch(error => console.log('Error:', error))

const p1 = new Promise(
    (resolve, reject) => {
        setTimeout(
            () => {
                resolve('message1')
            },
            1000,
        )
    }
);

const p2 = new Promise(
    (resolve, reject) => {
        setTimeout(
            () => {
                resolve('message2')
            },
            1700,
        )
    }
);

// Promise.all([p1, p2])
//     .then(result => console.log(result))
//     .catch(error => console.log('Error:', error))

// Promise.race([p1, p2])
//     .then(result => console.log(result))
//     .catch(error => console.log('Error:', error))

// async function valami() { }
// valami();

// IIFE - Immediately Invoked Function Expression
;(async () => {
    await Promise.all([p1, p2])
        .then(result => console.log(result))
        .catch(error => console.log('Error:', error))

    Promise.race([p1, p2])
        .then(result => console.log(result))
        .catch(error => console.log('Error:', error))
})();
