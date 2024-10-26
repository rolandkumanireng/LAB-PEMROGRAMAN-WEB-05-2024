
function startGameTebakan() {
    let angka = Math.floor(Math.random()*101);

    do {
        var tebakan = prompt("Masukan angka: ");
        if (tebakan > angka) {
            console.log("Tebakan Terlalu Besar")
        } else if (tebakan < angka) {
            console.log("Tebakan Terlalu Kecil")

        } else {
            console.log("Selamat Anda Menebak Angka " + angka + " dengan benar!");

        }
    } while (tebakan != angka);


}
startGameTebakan();



// function startGameTebakan() {
//     let angka = Math.floor(Math.random() * 101);

//     do {
//         var tebakan = prompt("Masukan angka: ");
//         if (tebakan > angka) {
//             console.log("Tebakan Terlalu Besar")
//         } else if (tebakan < angka) {
//             console.log("Tebakan Terlalu Kecil")

//         } else {
//             console.log("Selamat Anda Menebak Angka " + angka + " dengan benar!");

//         }
//     } while (tebakan != angka);


// }

// startGameTebakan();