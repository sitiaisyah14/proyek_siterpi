describe("Mengedit data stok obat dengan semua data valid", () => {
    it("Berhasil memperbarui data stok obat", () => {
        cy.visit("http://localhost:8000/historydrug/15/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#drug_id').select('Kudix');
            cy.get('#masuk').clear().type('20');
            cy.get('#keluar').clear().type('0');
            cy.get('.btn-primary').click();
        });
    });
});
describe("Mengedit data stok obat dengan nama obat tidak valid", () => {
    it("Gagal memperbarui data stok obat", () => {
        cy.visit("http://localhost:8000/historydrug/15/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#drug_id').select('-- Pilih Nama Obat --');
            cy.get('#masuk').clear().type('10');
            cy.get('#keluar').clear().type('0');
            cy.get('.btn-primary').click();
        });
    });
});
describe("Mengedit data stok obat dengan stok masuk tidak valid", () => {
    it("Gagal memperbarui data stok obat", () => {
        cy.visit("http://localhost:8000/historydrug/15/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#drug_id').select('Kudix');
            cy.get('#masuk').clear();
            cy.get('#keluar').clear().type('0');
            cy.get('.btn-primary').click();
        });
    });
});
describe("Mengedit data stok obat dengan stok keluar tidak valid", () => {
    it("Gagal memperbarui data stok obat", () => {
        cy.visit("http://localhost:8000/historydrug/15/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#drug_id').select('Kudix');
            cy.get('#masuk').clear().type('10');
            cy.get('#keluar').clear();
            cy.get('.btn-primary').click();
        });
    });
});
