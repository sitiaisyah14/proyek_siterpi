describe("Akses halaman pakan", () => {
    it("Berhasil mengakses halaman pakan", () => {
        cy.visit("http://localhost:8000/feed");
        cy.get("form").within(() => {
            cy.get("[id^=yourUsername]").type("admin");
            cy.get("[id^=yourPassword]").type("admin");
        });
        cy.contains('Masuk').click();
    });
});

describe("Menambahkan data pakan baru dengan semua data valid", () => {
    it("Berhasil menambahkan data pakan", () => {
        cy.visit("http://localhost:8000/feed/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#nama_pakan').type('Konsentrat Mix123');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Menambahkan data pakan baru dengan nama pakan tidak valid", () => {
    it("Gagal menambahkan data pakan", () => {
        cy.visit("http://localhost:8000/feed/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('.btn-primary').click();
        });
    });
});
