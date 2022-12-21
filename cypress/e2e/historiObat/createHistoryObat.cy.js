describe("Akses halaman stok obat", () => {
    it("Berhasil mengakses halaman stok obat", () => {
        cy.visit("http://localhost:8000/historydrug");
        cy.get("form").within(() => {
            cy.get("[id^=yourUsername]").type("admin");
            cy.get("[id^=yourPassword]").type("admin");
        });
        cy.contains('Masuk').click();
    });
})

describe("Menambahkan data stok obat baru dengan semua data valid", () => {
    it("Berhasil menambahkan data stok obat", () => {
        cy.visit("http://localhost:8000/historydrug/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#drug_id').select('Pitazole');
            cy.get('#masuk').type('10');
            cy.get('#keluar').type('0');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Menambahkan data stok obat baru dengan nama obat tidak valid", () => {
    it("Gagal menambahkan data stok obat", () => {
        cy.visit("http://localhost:8000/historydrug/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#drug_id').select('-- Pilih Nama Obat --');
            cy.get('#masuk').type('10');
            cy.get('#keluar').type('0');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Menambahkan data obat baru dengan stok masuk tidak valid", () => {
    it("Gagal menambahkan data stok obat", () => {
        cy.visit("http://localhost:8000/historydrug/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#drug_id').select('Pitazole');
            cy.get('#keluar').type('0');
            cy.get('.btn-primary').click();
        });
    });
});
describe("Menambahkan data obat baru dengan stok keluar tidak valid", () => {
    it("Gagal menambahkan data stok obat", () => {
        cy.visit("http://localhost:8000/historydrug/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#drug_id').select('Pitazole');
            cy.get('#masuk').type('10');
            cy.get('.btn-primary').click();
        });
    });
});
