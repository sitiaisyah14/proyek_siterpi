describe("Akses halaman obat", () => {
    it("Berhasil mengakses halaman obat", () => {
        cy.visit("http://localhost:8000/drug");
        cy.get("form").within(() => {
            cy.get("[id^=yourUsername]").type("admin");
            cy.get("[id^=yourPassword]").type("admin");
        });
        cy.contains('Masuk').click();
    });
});

describe("Menambahkan data obat baru dengan semua data valid", () => {
    it("Berhasil menambahkan data obat", () => {
        cy.visit("http://localhost:8000/drug/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#nama_obat').type('Konsentrat Mix123');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Menambahkan data obat baru dengan nama obat tidak valid", () => {
    it("Gagal menambahkan data obat", () => {
        cy.visit("http://localhost:8000/drug/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('.btn-primary').click();
        });
    });
});
