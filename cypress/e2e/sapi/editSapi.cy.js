describe("Mengedit data sapi dengan semua data valid", () => {
    it("Berhasil memperbarui data sapi", () => {
        cy.visit("http://localhost:8000/farm/5/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#jk').select('Jantan');
            cy.get('#status').select('Terjual');
            cy.get('#kondisi').select('Sehat');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Mengedit data sapi dengan jenis kelamin tidak valid", () => {
    it("Gagal memperbarui data sapi", () => {
        cy.visit("http://localhost:8000/farm/4/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#jk').select('- Pilih Jenis Kelamin -');
            cy.get('#status').select('Terjual');
            cy.get('#kondisi').select('Sehat');
            cy.get('.btn-primary').click();
        });
    });
});
describe("Mengedit data sapi dengan status tidak valid", () => {
    it("Gagal memperbarui data sapi", () => {
        cy.visit("http://localhost:8000/farm/4/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#jk').select('Jantan');
            cy.get('#status').select('- Pilih Status -');
            cy.get('#kondisi').select('Sehat');
            cy.get('.btn-primary').click();
        });
    });
});
describe("Mengedit data sapi dengan kondisi tidak valid", () => {
    it("Gagal memperbarui data sapi", () => {
        cy.visit("http://localhost:8000/farm/4/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#jk').select('Jantan');
            cy.get('#status').select('Terjual');
            cy.get('#kondisi').select('- Pilih Kondisi -');
            cy.get('.btn-primary').click();
        });
    });
});
