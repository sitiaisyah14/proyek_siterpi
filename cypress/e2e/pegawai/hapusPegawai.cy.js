describe("Menghapus data pegawai", () => {
    it("Berhasil menghapus data pegawai", () => {
        cy.visit("http://localhost:8000/employee");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            // cy.visit("http://localhost:8000/employee/1/");
            cy.get('.btn-danger').first().click();
            cy.contains('Ya,hapus!').click();
        });
    });
});
