
function calculateDiskon(harga, jenis) {
    jenis = jenis.toLowerCase();
    let diskon;
    let Sdiskon;
    
    
    if (!isNaN(harga)) { 
        
        switch (jenis) {
            case "elektronik":
                diskon = 10 / 100;
                Sdiskon = "10%";
                break;
    
            case "pakaian":
                diskon = 20 / 100;
                Sdiskon = "20%";
                break;
    
            case "makanan":
                diskon = 5 / 100;
                Sdiskon = "5%";
                break;
    
            default:
                diskon = 0;
                Sdiskon = "0%";
                break;
        }
       
        
        let hasil = harga - harga * diskon;
    
        return "Harga awal: Rp " + harga + "\nDiskon: " + Sdiskon + "\nHarga Setelah Diskon: Rp " + hasil;
    } else {
        return "kasih masuk anggka.";
    }
}



let hargaBarang = prompt("Masukkan Harga Barang");
console.log(calculateDiskon(Number(hargaBarang), jenisBarang));

let jenisBarang = prompt("Masukkan Jenis Barang");

