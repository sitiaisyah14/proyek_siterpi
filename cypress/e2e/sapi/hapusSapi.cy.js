describe("Menghapus data sapi", () => {
    it("Berhasil menghapus data sapi", () => {
        cy.visit("http://localhost:8000/farm");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('.btn-danger').first().click();
            cy.contains('Ya,hapus!').click();
        });
    });
});
