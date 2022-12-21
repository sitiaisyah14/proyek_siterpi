describe("Akses halaman rekap kesehatan", () => {
    it("Berhasil mengakses halaman kesehatan", () => {
        cy.visit("http://localhost:8000/healthfarm");
        cy.get("form").within(() => {
            cy.get("[id^=yourUsername]").type("admin");
            cy.get("[id^=yourPassword]").type("admin");
        });
        cy.contains('Masuk').click();
    });
});

describe("Menambahkan data rekap kesehatan baru dengan semua data valid", () => {
    it("Berhasil menambahkan data rekap kesehatan", () => {
        cy.visit("http://localhost:8000/healthfarm/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#farm_id').select('107');
            cy.get('#tanggal').type('2022-12-01');
            cy.get('#keterangan').type('Demam');
            cy.get('#drug_id').select('Pitazole');
            cy.get('#jumlah').type('1');
            cy.get('#submit').click();
        });
    });
});

describe("Menambahkan data rekap kesehatan baru dengan nomor sapi tidak valid", () => {
    it("Gagal menambahkan data rekap kesehatan", () => {
        cy.visit("http://localhost:8000/healthfarm/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#tanggal').type('2022-12-01');
            cy.get('#keterangan').type('Demam');
            cy.get('#drug_id').select('Pitazole');
            cy.get('#jumlah').type('1');
            cy.get('#submit').click();
        });
    });
});

describe("Menambahkan data rekap kesehatan baru dengan tanggal tidak valid", () => {
    it("Gagal menambahkan data rekap kesehatan", () => {
        cy.visit("http://localhost:8000/healthfarm/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#farm_id').select('107');
            cy.get('#keterangan').type('Demam');
            cy.get('#drug_id').select('Pitazole');
            cy.get('#jumlah').type('1');
            cy.get('#submit').click();
        });
    });
});

describe("Menambahkan data rekap kesehatan baru dengan nama obat tidak valid", () => {
    it("Gagal menambahkan data rekap kesehatan", () => {
        cy.visit("http://localhost:8000/healthfarm/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#farm_id').select('107');
            cy.get('#tanggal').type('2022-12-01');
            cy.get('#keterangan').type('Demam');
            cy.get('#jumlah').type('1');
            cy.get('#submit').click();
        });
    });
});

describe("Menambahkan data rekap kesehatan baru dengan jumlah obat tidak valid", () => {
    it("Gagal menambahkan data rekap kesehatan", () => {
        cy.visit("http://localhost:8000/healthfarm/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#farm_id').select('107');
            cy.get('#tanggal').type('2022-12-01');
            cy.get('#keterangan').type('Demam');
            cy.get('#drug_id').select('Pitazole');
            cy.get('#submit').click();
        });
    });
});


