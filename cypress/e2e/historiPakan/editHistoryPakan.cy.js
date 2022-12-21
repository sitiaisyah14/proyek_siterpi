describe("Mengedit data stok pakan baru dengan semua data valid", () => {
    it("Berhasil memperbarui data stok pakan", () => {
        cy.visit("http://localhost:8000/historyfeed/8/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#feed_id').select('Nutrifeed');
            cy.get('#masuk').clear().type('20');
            cy.get('#keluar').clear().type('0');
            cy.get('.btn-primary').click();
        });
    });
});
describe("Mengedit data stok pakan dengan nama pakan tidak valid", () => {
    it("Gagal memperbarui data stok pakan", () => {
        cy.visit("http://localhost:8000/historyfeed/8/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#feed_id').select('-- Pilih Nama Pakan --');
            cy.get('#masuk').clear().type('10');
            cy.get('#keluar').clear().type('0');
            cy.get('.btn-primary').click();
        });
    });
});
describe("Mengedit data stok pakan dengan stok masuk tidak valid", () => {
    it("Gagal memperbarui data stok pakan", () => {
        cy.visit("http://localhost:8000/historyfeed/8/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#feed_id').select('Nutrifeed');
            cy.get('#masuk').clear();
            cy.get('#keluar').clear().type('0');
            cy.get('.btn-primary').click();
        });
    });
});
describe("Mengedit data stok pakan dengan stok keluar tidak valid", () => {
    it("Gagal memperbarui data stok pakan", () => {
        cy.visit("http://localhost:8000/historyfeed/8/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#feed_id').select('Nutrifeed');
            cy.get('#masuk').clear().type('10');
                cy.get('#keluar').clear();
            cy.get('.btn-primary').click();
        });
    });
});
