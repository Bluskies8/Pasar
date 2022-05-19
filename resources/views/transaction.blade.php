<form action="transaction/create" method="post">
    @csrf
    <input type="text" name="stand_id" id="stand_id" placeholder = "Stand"><br>

    <input type="text" name="nama_barang" id="nama_barang" placeholder = "Nama Barang"><br>
    <input type="text" name="tipe_berat" id="tipe_berat" placeholder = "Tipe Berat"><br>
    <input type="text" name="jumlah" id="jumlah" placeholder = "jumlah"><br>
    <input type="text" name="harga" id="harga" placeholder = "harga"><br>
    <input type="text" name="subtotal" id="subtotal" placeholder = "subtotal"><br>
    <button type="submit">submit</button>
</form>
<button onclick="add()">add Barang</button>

{{-- bisa kirim data json kek seng bawah iki gk?? --}}
{{-- {
    "stand_id" : "1",
    "items": [
        {
            "nama_barang" : "salak",
            "tipe_berat" : "KG",
            "jumlah" : "50",
            "harga" : "",
            "subtotal" : ""
        },
        {
            "nama_barang" : "apel",
            "tipe_berat" : "KG",
            "jumlah" : "100",
            "harga" : "",
            "subtotal" : ""
        }
    ]
} --}}

<script>
    $( document ).ready(function() {
        console.log( "ready!" );
        let count_barang = 1;
        function handleFormSubmit(event) {
        event.preventDefault();

        const data = new FormData(event.target);

        const formJSON = Object.fromEntries(data.entries());

        // for multi-selects, we need special handling
        formJSON.snacks = data.getAll('snacks');

        const results = document.querySelector('.results pre');
        results.innerText = JSON.stringify(formJSON, null, 2);
        }

        const form = document.querySelector('.contact-form');
        form.addEventListener('submit', handleFormSubmit);

        $( "#add" ).on("click",(function() {
            alert( "Handler for .click() called." );
        }));
        function add() {
            count_barang++;
        }
</script>
