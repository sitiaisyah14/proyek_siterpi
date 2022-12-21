describe("Akses halaman stok pakan", () => {
    it("Berhasil mengakses halaman stok pakan", () => {
        cy.visit("http://localhost:8000/historyfeed");
        cy.get("form").within(() => {
            cy.get("[id^=yourUsername]").type("admin");
            cy.get("[id^=yourPassword]").type("admin");
        });
        cy.contains('Masuk').click();
    });
})

describe("Menambahkan data stok pakan baru dengan semua data valid", () => {
    it("Berhasil menambahkan data stok pakan", () => {
        cy.visit("http://localhost:8000/historyfeed/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#feed_id').select('Nutrifeed');
            cy.get('#masuk').type('10');
            cy.get('#keluar').type('0');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Menambahkan data stok pakan baru dengan nama pakan tidak valid", () => {
    it("Gagal menambahkan data stok pakan", () => {
        cy.visit("http://localhost:8000/historyfeed/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#feed_id').select('-- Pilih Nama Pakan --');
            cy.get('#masuk').type('10');
            cy.get('#keluar').type('0');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Menambahkan data pakan baru dengan stok masuk tidak valid", () => {
    it("Gagal menambahkan data stok pakan", () => {
        cy.visit("http://localhost:8000/historyfeed/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#feed_id').select('Nutrifeed');
            cy.get('#keluar').type('0');
            cy.get('.btn-primary').click();
        });
    });
});
describe("Menambahkan data pakan baru dengan stok keluar tidak valid", () => {
    it("Gagal menambahkan data stok pakan", () => {
        cy.visit("http://localhost:8000/historyfeed/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#feed_id').select('Nutrifeed');
            cy.get('#masuk').type('10');
            cy.get('.btn-primary').click();
        });
    });
});
