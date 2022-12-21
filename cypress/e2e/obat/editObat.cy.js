describe("Mengedit data pbat dengan semua data valid", () => {
    it("Berhasil memperbarui data obat", () => {
        cy.visit("http://localhost:8000/drug/4/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#nama_obat').clear().type('Colibat23');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Mengedit data pbat dengan nama obat tidak valid", () => {
    it("Gagal memperbarui data obat", () => {
        cy.visit("http://localhost:8000/drug/4/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#nama_obat').clear();
            cy.get('.btn-primary').click();
        });
    });
});
