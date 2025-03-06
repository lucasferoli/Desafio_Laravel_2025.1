
          <div>
              <h1>Criar Produto</h1>
          </div>

          <div>
              <label for="inputNome">Nome do Produto:</label>
              <input id="inputNome" required name="nome" placeholder="Digite o nome do produto *" />
              <div>
                  <p id="avisoContadorNome"></p>
                  <p id="contadorNome"></p>
              </div>
          </div>

          <div>
              <label for="inputDescricao">Descrição:</label>
              <textarea id="inputDescricao" required name="descricao" placeholder="Digite a descrição do produto *"></textarea>
              <div>
                  <p id="avisoContadorDescricao"></p>
                  <p id="contadorDescricao"></p>
              </div>
          </div>

          <div>
              <label for="inputPreco">Preço:</label>
              <input id="inputPreco" required name="preco" placeholder="Digite o preço do produto *" />
              <div>
                  <p id="avisoContadorPreco"></p>
                  <p id="contadorPreco"></p>
              </div>
          </div>

          <div>
              <button type="button">
                  <label>
                      <p>Adicionar Foto *</p>
                      <input type="file" id="file" name="imagem" multiple />
                  </label>
              </button>
              <p id="avisoContadorFoto"></p>
          </div>

          <div>
              <button id="botaoCriarProduto" type="submit">Criar</button>
              <button onclick="fecharModal('modalCriar')" type="button" id="botao-cancelar">Cancelar</button>
          </div>
      </div>
  </form>
</div>