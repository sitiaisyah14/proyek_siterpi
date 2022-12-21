describe("Menghapus data stok pakan", () => {
    it("Berhasil menghapus data stok pakan", () => {
        cy.visit("http://localhost:8000/historyfeed");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('.btn-danger').first().click();
            cy.contains('Ya,hapus!').click();
        });
    });
});
