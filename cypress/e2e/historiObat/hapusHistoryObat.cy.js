describe("Menghapus data stok obat", () => {
    it("Berhasil menghapus data stok obat", () => {
        cy.visit("http://localhost:8000/historydrug");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            // cy.get('.btn-danger').first().click();
            // cy.contains('Ya,hapus!').click();
        });
    });
});
