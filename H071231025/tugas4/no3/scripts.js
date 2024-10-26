const daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

function theDayCounter(target, today) {
    today = daysOfWeek.indexOf(today);

    while (target > 0) {
        if (today >= 6) {
            today = 0;
            target -= 1;
        } else {
            today += 1;
            target -= 1;
        }
        console.log(today);
    }

    console.log(daysOfWeek[today]);
}

let today;
do {
    today = prompt("Masukkan Hari").toLowerCase();
} while (!daysOfWeek.includes(today));

let target;
do {
    target = parseInt(prompt("Masukkan berapa hari"));
} while (isNaN(target));

theDayCounter(target, today);
