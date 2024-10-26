// nomor 1
function countEvenNumbers(start, end) {
    let evenNumber = [];
    for (let i = start; i <= end; i++) {
        if (!(i % 2)) {
            evenNumber.push(i);
        }
    }
    return (evenNumber.length.toString() + "(").concat(evenNumber.toString() + ")");

}
console.log(countEvenNumbers(1, 10));
console.log(countEvenNumbers(5, 20));


