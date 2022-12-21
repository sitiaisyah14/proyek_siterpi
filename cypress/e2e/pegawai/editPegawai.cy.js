describe("Mengedit data pegawai dengan semua data valid", () => {
    it("Berhasil memperbarui data pegawai", () => {
        cy.visit("http://localhost:8000/employee/8/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#foto').selectFile('cypress/e2e/pegawai/foto/profile-img.jpg');
            cy.get('#nama').clear().type('Deatrisya Mirela Harahap');
            cy.get('[type="radio"]').check('P')
            cy.get('#tempat_lahir').clear().type('Pasuruan');
            cy.get('#tgl_lahir').clear().type('2001-12-18');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Mengedit data pegawai dengan foto tidak valid", () => {
    it("Gagal memperbarui data pegawai", () => {
        cy.visit("http://localhost:8000/employee/8/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#foto').selectFile('cypress/e2e/pegawai/foto/highRes.jpg');
            cy.get('#nama').clear().type('Deatrisya');
            cy.get('[type="radio"]').check('P')
            cy.get('#tempat_lahir').clear().type('Pasuruan');
            cy.get('#tgl_lahir').clear().type('2001-12-18');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Mengedit data pegawai dengan nama tidak valid", () => {
    it("Gagal memperbarui data pegawai", () => {
        cy.visit("http://localhost:8000/employee/8/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#foto').selectFile('cypress/e2e/pegawai/foto/profile-img.jpg');
            cy.get('#nama').clear().type('Dea123');
            cy.get('[type="radio"]').check('P')
            cy.get('#tempat_lahir').clear().type('Pasuruan');
            cy.get('#tgl_lahir').type('2001-12-18');
            cy.get('.btn-primary').click();
        });
    });
});

describe("Mengedit data pegawai dengan tempat lahir tidak valid", () => {
    it("Gagal memperbarui data pegawai", () => {
        cy.visit("http://localhost:8000/employee/8/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#foto').selectFile('cypress/e2e/pegawai/foto/profile-img.jpg');
            cy.get('#nama').clear().type('Deatrisya');
            cy.get('[type="radio"]').check('P')
            cy.get('#tempat_lahir').clear();
            cy.get('#tgl_lahir').clear().type('2001-12-18');
            cy.get('.btn-primary').click();
        });
    });
});


describe("Mengedit data pegawai dengan tanggal lahir tidak valid", () => {
    it("Gagal memperbarui data pegawai", () => {
        cy.visit("http://localhost:8000/employee/8/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#foto').selectFile('cypress/e2e/pegawai/foto/profile-img.jpg');
            cy.get('#nama').clear().type('Deatrisya');
            cy.get('[type="radio"]').check('P')
            cy.get('#tempat_lahir').clear().type('Pasuruan');
            cy.get('#tgl_lahir').clear();
            cy.get('.btn-primary').click();
        });
    });
});
