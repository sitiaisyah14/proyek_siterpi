describe("Menghapus data rekap kesehatan", () => {
    it("Gagal menghapus data rekap kesehatan", () => {
        cy.visit("http://localhost:8000/healthfarm");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('.btn-danger').first().click();
            cy.contains('Ya,hapus!').click();
        });
    });
});
