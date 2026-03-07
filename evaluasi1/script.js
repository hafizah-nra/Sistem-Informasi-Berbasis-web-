function showPage(page) {
    document.getElementById('pageHome').style.display       = 'none';
    document.getElementById('pageMenu').style.display       = 'none';
    document.getElementById('pageCalculator').style.display = 'none';

    document.querySelectorAll('.nav-btn').forEach(function(btn) {
        btn.classList.remove('active');
    });

    if (page === 'home') {
        document.getElementById('pageHome').style.display = 'flex';
        document.getElementById('btnHome').classList.add('active');

    } else if (page === 'menu') {
        document.getElementById('pageMenu').style.display = 'block';
        document.getElementById('btnMenu').classList.add('active');
        promptMenuInput();

    } else if (page === 'calculator') {
        document.getElementById('pageCalculator').style.display = 'block';
        document.getElementById('btnCalc').classList.add('active');
    }
}

function doShout() {
    alert('Hai, Selamat datang di Sistem Sederhana');
}

var harga = [12000, 10000, 15000];

function promptMenuInput() {
    var jumlah = prompt('Input Jumlah Pesanan agar di hitung otomatis oleh sistem');
    if (jumlah === null || jumlah.trim() === '') {
        hitungTotal();
        return;
    }
    document.getElementById('p1').value = parseInt(jumlah) || 0;
    hitungTotal();
}

function hitungTotal() {
    var p1 = parseInt(document.getElementById('p1').value) || 0;
    var p2 = parseInt(document.getElementById('p2').value) || 0;
    var p3 = parseInt(document.getElementById('p3').value) || 0;

    var total  = (p1 * harga[0]) + (p2 * harga[1]) + (p3 * harga[2]);
    var diskon = 0;

    if (total > 50000) {
        diskon = total * 0.1;
    }

    var bayar = total - diskon;

    document.getElementById('jumlahTotal').value = total;
    document.getElementById('diskon').value      = diskon;
    document.getElementById('jumlahBayar').value = bayar;
}

function resetMenu() {
    document.getElementById('p1').value          = 0;
    document.getElementById('p2').value          = 0;
    document.getElementById('p3').value          = 0;
    document.getElementById('jumlahTotal').value = 0;
    document.getElementById('diskon').value      = 0;
    document.getElementById('jumlahBayar').value = 0;
}

function doCalc() {
    var aVal = document.getElementById('calcA').value;
    var bVal = document.getElementById('calcB').value;

    if (aVal === '' || bVal === '') {
        document.getElementById('calcResult').value = '';
        return;
    }

    var a  = parseFloat(aVal);
    var b  = parseFloat(bVal);
    var op = document.getElementById('calcOp').value;

    var result;
    if      (op === '+') result = a + b;
    else if (op === '-') result = a - b;
    else if (op === '*') result = a * b;
    else if (op === '/') result = b !== 0 ? a / b : 'Error';
    else if (op === '^') result = Math.pow(a, b);
    else if (op === '%') result = a % b;

    document.getElementById('calcResult').value = result;
}

function resetCalc() {
    document.getElementById('calcA').value      = '';
    document.getElementById('calcB').value      = '';
    document.getElementById('calcResult').value = '';
}

document.addEventListener('DOMContentLoaded', function () {
    showPage('home');
});