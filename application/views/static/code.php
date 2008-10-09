# Kody dla oprogramowania zewnętrznego

Oczywiste jest, że codzienne wprowadzanie liczby ułożeń przez interfejs WWW jest dość uciążliwe. Jednakże, jeżeli Twój komputerowy timer wspiera tą opcję, możesz wysyłać swoje wyniki za jego pośrednictwem!

## Dla użytkowników

Aby skorzystać z tej funkcjonalności, wystarczy wejść na stronę [Moje konto / Pobierz kod dostępu dla oprogramowania zewnętrznego](account/code).
Zostanie wygenerowany Twój unikalny kod. Podaj go swojemu timerowi, a on już będzie wiedział, co zrobić dalej.

## Dla twórców oprogramowania

Kod dla oprogramowania zewnętrznego (zwany dalej Kodem) ułatwia zdalne wysyłanie wyników na stronę Miliona. Zamiast potrzeby sztucznego logowania się, trzymania ciasteczek itp. Kod umożliwia bezstresowe wysłanie wyniku za pomocą jednego tylko zapytania HTTP.

Aktualnie istnieją dwie dostępne funkcje:

**<?=url::base(TRUE);?>api/categories/**

Po wywołaniu powyższej strony (poprzez zwykłe zapytanie HTTP) zwrócona zostanie lista dostępnych kategorii wyników w następującym formacie:

    id;nazwa_kostki;metoda_kostki

Każdy taki wpis znajduje się w osobnej linii.

**<?=url::base(TRUE);?>api/submit/{code}/{category}/{value}/{prefix}**

Ta funkcja umożliwia wysłanie wyniku. Parametry tej funkcji to:

+  {code} - Kod, podany przez użytkownika
+  {category} - Kategoria (ich listę można pobrać korzystając z poprzedniej funkcji)
+  {value} - Ilość ułożeń
+  {prefix} - (parametr opcjonalny) Tekst, który zostanie dodany do początku zwróconego komunikatu (np. prefix='RET_' zwróci w przypadku błędu RET_ERROR)

Funkcja zwraca następujące wyniki:

+  OK - Wynik został wysłany
+  BADCODE - Został podany zły kod
+  NOACCESS - Użytkownik nie ma uprawnień do wysyłania wyników
+  ERROR bądź cokolwiek innego, co nie jest którąś z dozwolonych wartości - Wystąpił błąd wewnętrzny