var myFunc = function () {
  console.log('hello world!');
};

myFunc();

var regex = 'Rp. 3.000';

const parseRupiah = str => parseInt(str.split(' ')[1].split('.').join(''));

console.log(parseRupiah(regex));

const factorial = n => {
  let res = 0;
  let end = n - (n - 1);
  for (let i = n; i >= end; i--) {
    i === n ? (res = i) : (res *= i);
  }
  return res;
};
console.log(factorial(8));

// const current = new Date('8/11/2021').getTime();
// const lusa = new Date('8/12/2021').getTime();
const cobain = new Date('8/13/2021').getTime();
console.log(cobain);
