// describe("Akses halaman User", () => {
//     it("Berhasil mengakses halaman User", () => {
//         cy.visit("http://localhost:8000/user");
//         cy.get("form").within(() => {
//             cy.get("[id^=yourUsername]").type("admin");
//             cy.get("[id^=yourPassword]").type("admin");
//         });
//         cy.contains('Masuk').click();
//     });
// });

// describe("Menambahkan data User baru dengan semua data valid", () => {
//     it("Berhasil menambahkan data User", () => {
//         cy.visit("http://localhost:8000/user/create");
//         cy.get("form").within(() => {
//             cy.get('#yourUsername').type('admin');
//             cy.get('#yourPassword').type('admin');
//             cy.contains('Masuk').click();
//             cy.get('#foto').selectFile('cypress/e2e/user/foto/profile-img.jpg');
//             cy.get('#nama').type('Deatrisya');
//             cy.get('#username').type('admin9');
//             cy.get('#password').type('12345678');
//             cy.get('#position').select('Admin');
//             cy.get('.btn-primary').click();
//         });
//     });
// });

// describe("Menambahkan data User baru dengan foto tidak valid", () => {
//     it("Gagal menambahkan data User", () => {
//         cy.visit("http://localhost:8000/user/create");
//         cy.get("form").within(() => {
//             cy.get('#yourUsername').type('admin');
//             cy.get('#yourPassword').type('admin');
//             cy.contains('Masuk').click();
//             cy.get('#nama').type('Deatrisya');
//             cy.get('#username').type('admin1');
//             cy.get('#password').type('12345678');
//             cy.get('#position').select('Admin');
//             cy.get('.btn-primary').click();
//         });
//     });
// });
// describe("Menambahkan data User baru dengan nama tidak valid", () => {
//     it("Gagal menambahkan data User", () => {
//         cy.visit("http://localhost:8000/user/create");
//         cy.get("form").within(() => {
//             cy.get('#yourUsername').type('admin');
//             cy.get('#yourPassword').type('admin');
//             cy.contains('Masuk').click();
//             cy.get('#foto').selectFile('cypress/e2e/user/foto/profile-img.jpg');
//             cy.get('#username').type('admin1');
//             cy.get('#password').type('12345678');
//             cy.get('#position').select('Admin');
//             cy.get('.btn-primary').click();
//         });
//     });
// });

// describe("Menambahkan data User baru dengan username tidak valid", () => {
//     it("Gagal menambahkan data User", () => {
//         cy.visit("http://localhost:8000/user/create");
//         cy.get("form").within(() => {
//             cy.get('#yourUsername').type('admin');
//             cy.get('#yourPassword').type('admin');
//             cy.contains('Masuk').click();
//             cy.get('#foto').selectFile('cypress/e2e/user/foto/profile-img.jpg');
//             cy.get('#nama').type('Deatrisya');
//             cy.get('#password').type('12345678');
//             cy.get('#position').select('Admin');
//             cy.get('.btn-primary').click();
//         });
//     });
// });

describe("Menambahkan data User baru dengan password tidak valid", () => {
    it("Gagal menambahkan data User", () => {
        cy.visit("http://localhost:8000/user/create");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#foto').selectFile('cypress/e2e/user/foto/profile-img.jpg');
            cy.get('#nama').type('Deatrisya');
            cy.get('#username').type('admin1');
            cy.get('#position').select('Admin');
            cy.get('.btn-primary').click();
        });
    });
});


