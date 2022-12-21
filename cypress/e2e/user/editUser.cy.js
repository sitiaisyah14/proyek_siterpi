// describe("Mengedit data user dengan semua data valid", () => {
//     it("Berhasil memperbarui data user", () => {
//         cy.visit("http://localhost:8000/user/8/edit");
//         cy.get("form").within(() => {
//             cy.get('#yourUsername').type('admin');
//             cy.get('#yourPassword').type('admin');
//             cy.contains('Masuk').click();
//             cy.get('#foto').selectFile('cypress/e2e/user/foto/profile-img.jpg');
//             cy.get('#nama').clear().type('Deatrisya');
//             cy.get('#username').clear().type('admin10');
//             cy.get('#password').clear().type('12345678');
//             cy.get('#password_confirmation').clear().type('12345678');
//             cy.get('#position').select('Admin');
//             cy.get('.btn-primary').click();
//         });
//     });
// });

// describe("Mengedit data user dengan foto tidak valid", () => {
//     it("Gagal memperbarui data user", () => {
//         cy.visit("http://localhost:8000/user/8/edit");
//         cy.get("form").within(() => {
//             cy.get('#yourUsername').type('admin');
//             cy.get('#yourPassword').type('admin');
//             cy.contains('Masuk').click();
//             cy.get('#foto').selectFile('cypress/e2e/user/foto/highRes.jpg');
//             cy.get('#nama').clear().type('Deatrisya');
//             cy.get('#username').clear().type('admin10');
//             cy.get('#password').clear().type('12345678');
//             cy.get('#password_confirmation').clear().type('12345678');
//             cy.get('#position').select('Admin');
//             cy.get('.btn-primary').click();
//         });
//     });
// });
// describe("Mengedit data user dengan nama tidak valid", () => {
//     it("Gagal memperbarui data user", () => {
//         cy.visit("http://localhost:8000/user/8/edit");
//         cy.get("form").within(() => {
//             cy.get('#yourUsername').type('admin');
//             cy.get('#yourPassword').type('admin');
//             cy.contains('Masuk').click();
//             cy.get('#foto').selectFile('cypress/e2e/user/foto/profile-img.jpg');
//             cy.get('#nama').clear();
//             cy.get('#username').clear().type('admin1');
//             cy.get('#password').clear().type('12345678');
//             cy.get('#password_confirmation').clear().type('12345678');
//             cy.get('#position').select('Admin');
//             cy.get('.btn-primary').click();
//         });
//     });
// });
// describe("Mengedit data user dengan username tidak valid", () => {
//     it("Gagal memperbarui data user", () => {
//         cy.visit("http://localhost:8000/user/8/edit");
//         cy.get("form").within(() => {
//             cy.get('#yourUsername').type('admin');
//             cy.get('#yourPassword').type('admin');
//             cy.contains('Masuk').click();
//             cy.get('#foto').selectFile('cypress/e2e/user/foto/profile-img.jpg');
//             cy.get('#nama').clear().type('Deatrisya');
//             cy.get('#username').clear()
//             cy.get('#password').clear().type('12345678');
//             cy.get('#password_confirmation').clear().type('12345678');
//             cy.get('#position').select('Admin');
//             cy.get('.btn-primary').click();
//         });
//     });
// });
describe("Mengedit data user dengan password tidak valid", () => {
    it("Gagal memperbarui data user", () => {
        cy.visit("http://localhost:8000/user/8/edit");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
            cy.get('#foto').selectFile('cypress/e2e/user/foto/profile-img.jpg');
            cy.get('#nama').clear().type('Deatrisya');
            cy.get('#username').clear().type('admin11');
            cy.get('#password').clear().type('123456');
            cy.get('#password_confirmation').clear().type('123456789');
            cy.get('#position').select('Admin');
            cy.get('.btn-primary').click();
        });
    });
});
