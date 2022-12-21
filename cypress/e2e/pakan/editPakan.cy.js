describe("Mengedit data pakan dengan semua data valid", () => {
    it("Berhasil memperbarui data sapi", () => {
        cy.visit("http://localhost:8000/feed/5/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#nama_pakan').clear().type('Konsentrat Mixfeed');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Mengedit data pakan dengan nama pakan tidak valid", () => {
    it("Gagal memperbarui data sapi", () => {
        cy.visit("http://localhost:8000/feed/5/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#nama_pakan').clear();
            cy.get('.btn-primary').click();
        });
    });
});
