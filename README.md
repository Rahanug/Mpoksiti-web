GIT WORKFLOW

Commit ke new branch, di pull req nanti setelah merged baru new branch di delete

1. git pull
2. git checkout -b "nama_branch"
3. git add . 
4. git commit -m "message_commit"
5. git push 
6. pull req lewat website

Setelah selesai jgn lupa "git checkout main" trus "git pull"

Pull Request -> notif ke grup PKL GAS GAS, tunggu 1-2 hari kalau belum ada yg merge monggo di merge sendiri tp JGN LUPA NOTIF KE GRUP

How to Rebase

    pindah ke branch main
    git pull
    pindah ke branch lokal mu
    git rebase main

klo ada yg conflict

    di resolve trus git add . trus git commit -m "msg"
    git rebase --continue
    ulang sampe sukses

.env
DB_DATABASE=db_mpoksiti
DB_USERNAME=sesuain sqlsrv mu
DB_PASSWORD=sesuain sqlsrv mu

DB_DATABASE2=db_view_test
DB_USERNAME2=sesuain sqlsrv mu
DB_PASSWORD2=sesuain sqlsrv mu

Requirements:
PHP 8.0
php extension=gd enabled (cek xampp/php/php.ini)