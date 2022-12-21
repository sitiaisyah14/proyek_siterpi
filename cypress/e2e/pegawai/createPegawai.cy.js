describe("Akses halaman pegawai", () => {
    it("Berhasil mengakses halaman pegawai", () => {
        cy.visit("http://localhost:8000/employee");
        cy.get("form").within(() => {
            cy.get("[id^=yourUsername]").type("admin");
            cy.get("[id^=yourPassword]").type("admin");
        });
        cy.contains('Masuk').click();
    });
});

describe("Menambahkan data pegawai baru dengan semua data valid", () => {
    it("Berhasil menambahkan data pegawai", () => {
        cy.visit("http://localhost:8000/employee/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#foto').selectFile('cypress/e2e/pegawai/foto/profile-img.jpg');
            cy.get('#nama').type('Deatrisya');
            cy.get('[type="radio"]').check('P')
            cy.get('#tempat_lahir').type('Pasuruan');
            cy.get('#tgl_lahir').type('2001-12-18');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Menambahkan data pegawai baru dengan foto tidak valid", () => {
    it("Gagal menambahkan data pegawai", () => {
        cy.visit("http://localhost:8000/employee/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#foto').selectFile('cypress/e2e/pegawai/foto/highRes.jpg');
            cy.get('#nama').type('Deatrisya');
            cy.get('[type="radio"]').check('P')
            cy.get('#tempat_lahir').type('Pasuruan');
            cy.get('#tgl_lahir').type('2001-12-18');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Menambahkan data pegawai baru dengan nama tidak valid", () => {
    it("Gagal menambahkan data pegawai", () => {
        cy.visit("http://localhost:8000/employee/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#foto').selectFile('cypress/e2e/pegawai/foto/profile-img.jpg');
            // cy.get('#nama').type('');
            cy.get('[type="radio"]').check('P')
            cy.get('#tempat_lahir').type('Pasuruan');
            cy.get('#tgl_lahir').type('2001-12-18');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Menambahkan data pegawai baru dengan tempat lahir tidak valid", () => {
    it("Gagal menambahkan data pegawai", () => {
        cy.visit("http://localhost:8000/employee/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#foto').selectFile('cypress/e2e/pegawai/foto/profile-img.jpg');
            cy.get('#nama').type('Deatrisya');
            cy.get('[type="radio"]').check('P')
            // cy.get('#tempat_lahir').type('Pasuruan');
            cy.get('#tgl_lahir').type('2001-12-18');
            cy.get('.btn-primary').click();
        });
    });
});


describe("Menambahkan data pegawai baru dengan tanggal lahir tidak valid", () => {
    it("Gagal menambahkan data pegawai", () => {
        cy.visit("http://localhost:8000/employee/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#foto').selectFile('cypress/e2e/pegawai/foto/profile-img.jpg');
            cy.get('#nama').type('Deatrisya');
            cy.get('[type="radio"]').check('P')
            cy.get('#tempat_lahir').type('Pasuruan');
            // cy.get('#tgl_lahir').type('');
            cy.get('.btn-primary').click();
        });
    });
});


