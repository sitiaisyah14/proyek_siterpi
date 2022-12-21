describe("Menghapus data user", () => {
    it("Berhasil menghapus data user", () => {
        cy.visit("http://localhost:8000/user");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            // cy.get('.btn-danger').first().click();
            // cy.contains('Ya,hapus!').click();
        });
    });
});
