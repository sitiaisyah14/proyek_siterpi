describe("Akses halaman dashboard", () => {
    it("Berhasil mengakses halaman dashboard", () => {
        cy.visit("http://localhost:8000/home");
        cy.get("form").within(() => {
            cy.get("[id^=yourUsername]").type("admin");
            cy.get("[id^=yourPassword]").type("admin");
        });
        cy.contains('Masuk').click();
    });

});
