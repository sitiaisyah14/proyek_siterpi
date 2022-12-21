describe("Akses halaman sapi", () => {
    it("Berhasil mengakses halaman sapi", () => {
        cy.visit("http://localhost:8000/farm");
        cy.get("form").within(() => {
            cy.get("[id^=yourUsername]").type("admin");
            cy.get("[id^=yourPassword]").type("admin");
        });
        cy.contains('Masuk').click();
    });
});

describe("Menambahkan data sapi baru dengan semua data valid", () => {
    it("Berhasil menambahkan data sapi", () => {
        cy.visit("http://localhost:8000/farm/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#nis').type('123');
            cy.get('#jk').select('Betina');
            cy.get('#status').select('Belum Terjual');
            cy.get('#kondisi').select('Sehat');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Menambahkan data sapi baru dengan nis tidak valid", () => {
    it("Gagal menambahkan data sapi", () => {
        cy.visit("http://localhost:8000/farm/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#jk').select('Betina');
            cy.get('#status').select('Belum Terjual');
            cy.get('#kondisi').select('Sehat');
            cy.get('.btn-primary').click();
        });
    });
});
describe("Menambahkan data sapi baru dengan jenis kelamin tidak valid", () => {
    it("Gagal menambahkan data sapi", () => {
        cy.visit("http://localhost:8000/farm/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#nis').type('123');
            cy.get('#status').select('Belum Terjual');
            cy.get('#kondisi').select('Sehat');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Menambahkan data sapi baru dengan status tidak valid", () => {
    it("Gagal menambahkan data sapi", () => {
        cy.visit("http://localhost:8000/farm/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#nis').type('123');
            cy.get('#jk').select('Betina');
               cy.get('#status').select('Belum Terjual');
            cy.get('#kondisi').select('Sehat');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Menambahkan data sapi baru dengan kondisi tidak valid", () => {
    it("Gagal menambahkan data sapi", () => {
        cy.visit("http://localhost:8000/farm/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#nis').type('123');
            cy.get('#status').select('Belum Terjual');
            cy.get('#jk').select('Betina');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Menambahkan data sapi baru dengan nis, jenis kelamin,status dan kondisi tidak valid", () => {
    it("Gagal menambahkan data sapi", () => {
        cy.visit("http://localhost:8000/farm/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('.btn-primary').click();
        });
    });
});

