describe("Cek akses halaman login", () => {
    it("Cek URL Halaman login siterpi", () => {
        cy.visit("http://localhost:8000/login");
    })
})

describe("Login admin dengan username valid dan password valid", () => {
    it("Login berhasil", () => {
        cy.visit("http://localhost:8000/login");
        cy.get("form").within(() => {
            cy.get("[id^=yourUsername]").type("admin");
            cy.get("[id^=yourPassword]").type("admin");
        });
        cy.contains('Masuk').click();
    });
});


describe("Login admin dengan username valid dan password tidak valid", () => {
    it("Login gagal", () => {
        cy.visit("http://localhost:8000/login");
        cy.get("form").within(() => {
            cy.get("[id^=yourUsername]").type("admin");
            cy.get("[id^=yourPassword]").type("123");
        });
        cy.contains('Masuk').click();
    });
});

describe("Login admin dengan username tidak valid dan password valid", () => {
    it("Login gagal", () => {
        cy.visit("http://localhost:8000/login");
        cy.get("form").within(() => {
            cy.get("[id^=yourUsername]").type("123");
            cy.get("[id^=yourPassword]").type("admin");
        });
        cy.contains('Masuk').click();
    });
});

describe("Login admin dengan username tidak valid dan password tidak valid", () => {
    it("Login gagal", () => {
        cy.visit("http://localhost:8000/login");
        cy.get("form").within(() => {
            cy.get("[id^=yourUsername]").type("123");
            cy.get("[id^=yourPassword]").type("123");
        });
        cy.contains('Masuk').click();
    });
});
