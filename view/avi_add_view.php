<div class="comment_add_container">
  <div class="flexing">
      <a href="/avis" class="button_action go_to_link">Retour à mes avis</a>
      <h1 class="title">ecrire un avis</h1>
  </div>
    <form method="post" action="/avis/add" class="form-container">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">
        <input type="hidden" name="date" value="<?= date('Y-m-d H:i:s') ?>">
        <div class="grouping-color">

            <div class="form_group">
                <div class="rating-container">
                    <div class="stars" data-rating="3">
                        <span class="star" data-value="1"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="currentColor">
                                <path d="m354-287 126-76 126 77-33-144 111-96-146-13-58-136-58 135-146 13 111 97-33 143ZM233-120l65-281L80-590l288-25 112-265 112 265 288 25-218 189 65 281-247-149-247 149Zm247-350Z" />
                            </svg></span>
                        <span class="star" data-value="2"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="currentColor">
                                <path d="m354-287 126-76 126 77-33-144 111-96-146-13-58-136-58 135-146 13 111 97-33 143ZM233-120l65-281L80-590l288-25 112-265 112 265 288 25-218 189 65 281-247-149-247 149Zm247-350Z" />
                            </svg></span>
                        <span class="star" data-value="3"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="currentColor">
                                <path d="m354-287 126-76 126 77-33-144 111-96-146-13-58-136-58 135-146 13 111 97-33 143ZM233-120l65-281L80-590l288-25 112-265 112 265 288 25-218 189 65 281-247-149-247 149Zm247-350Z" />
                            </svg></span>
                        <span class="star" data-value="4"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="currentColor">
                                <path d="m354-287 126-76 126 77-33-144 111-96-146-13-58-136-58 135-146 13 111 97-33 143ZM233-120l65-281L80-590l288-25 112-265 112 265 288 25-218 189 65 281-247-149-247 149Zm247-350Z" />
                            </svg></span>
                        <span class="star" data-value="5"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="currentColor">
                                <path d="m354-287 126-76 126 77-33-144 111-96-146-13-58-136-58 135-146 13 111 97-33 143ZM233-120l65-281L80-590l288-25 112-265 112 265 288 25-218 189 65 281-247-149-247 149Zm247-350Z" />
                            </svg></span>
                    </div>
                </div>
                <input type="hidden" id="rate" name="rate" value="3">
            </div>
            <div class="form_group">
                <textarea id="content" name="content" required>Donner votre avis</textarea>
            </div>
        </div>
        <div class="form_group">
            <button type="submit" class="button_action">Envoyer</button>
        </div>
    </form>
   </div>