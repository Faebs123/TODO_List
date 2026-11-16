# 📝 TODO List Web App

Applicazione web full-stack per la gestione delle attività quotidiane, sviluppata con **HTML, CSS, JavaScript (Fetch API)** per il frontend e **PHP + MySQL** per il backend e la persistenza dei dati.

---

## 🗺️ Roadmap & Sviluppi Futuri

Questa sezione raccoglie le idee, le migliorie architetturali e le nuove funzionalità previste per l'evoluzione del progetto:

### 🎨 1. Esperienza Utente (UI/UX) e Frontend
* [ ] **Aggiornamento reattivo del DOM (Zero Reload):** Sostituire `window.location.reload()` con la manipolazione diretta del DOM. Al ricevimento della risposta dal server, i task eliminati verranno rimossi con un'animazione fluida senza ricaricare l'intera pagina.
* [ ] **Filtri e Ricerca Istantanea:** Aggiungere una barra di ricerca e filtri rapidi per visualizzare i task per stato (*Tutti*, *Da completare*, *Completati*) o per categoria.
* [ ] **Drag & Drop per l'ordinamento:** Implementare il trascinamento dei task (tramite API HTML5 Drag and Drop o librerie leggere) per permettere all'utente di riordinare manualmente le proprie priorità.
* [ ] **Dark Mode / Temi personalizzabili:** Aggiungere un selettore di tema con salvataggio della preferenza nel `localStorage` del browser.

### ⚡ 2. Nuove Funzionalità dell'Applicazione
* [ ] **Modifica in-line dei Task (Update):** Permettere di modificare il testo di un'attività già esistente facendo doppio clic su di essa, completando così tutte e quattro le operazioni CRUD (*Create, Read, Update, Delete*).
* [ ] **Scadenze, Priorità e Tag:** Estendere la tabella `tasks` nel database per supportare date di scadenza (`due_date`), livelli di priorità (*Bassa, Media, Alta*) ed etichette colorate.
* [ ] **Cestino e Ripristino (Soft Delete):** Invece di eliminare definitivamente i record con `DELETE`, aggiungere un flag `is_deleted` per spostare i task in un cestino temporaneo, dando all'utente la possibilità di annullare l'eliminazione.
* [ ] **Condivisione Liste:** Permettere a più utenti registrati di collaborare su una stessa lista condivisa.

### ⚙️ 3. Backend, Sicurezza e Architettura
* [ ] **Risposte API RESTful standardizzate:** Far restituire agli script PHP risposte strutturate in JSON (es. `{"success": true, "deleted_count": 3}`) accompagnate dai corretti codici di stato HTTP (`200 OK`, `400 Bad Request`, `401 Unauthorized`, `500 Internal Server Error`) per gestire gli errori in modo elegante sul frontend.
* [ ] **Protezione CSRF (Cross-Site Request Forgery):** Implementare token di sicurezza univoci per ogni sessione utente da inviare negli header delle richieste `fetch`, proteggendo le operazioni di scrittura ed eliminazione.
* [ ] **Ottimizzazione delle Query SQL:** Sostituire l'esecuzione di query multiple dentro un ciclo `foreach` con un'unica query dinamica basata sull'operatore `IN` (es. `DELETE FROM tasks WHERE user_id = ? AND id IN (?, ?, ?)`), riducendo il carico sul database.
