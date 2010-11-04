<?php

class NewsCommentsController extends Mvc_Controller_Base
{

	private function _backToNews($id = null)
	{

		if (!$id) {
			$id = $this->_request->id;
		}

		$this->_redirect("/newsline2.php?sid={$id}");
	}

	/**
	 * render: false
	 * @return void
	 */
	public function add()
	{

		if (!$this->_user()) {
			$this->_flashMessage('Вы не вошли в систему!');
			$this->_backToNews();
			return false;
		}

		if (trim($this->_request->text) == '') {
			$this->_flashMessage('Вы не ввели текст!');
			$this->_backToNews();
			return false;
		}

		if (!$this->_request->isPost()) {
			$this->_backToNews();
			return false;
		}

		$news = $this->_db('News')->find($this->_request->id);

		$comment = new NewsComment();
		$comment->text = $this->_request->text;
		$comment->author = $this->_user();
		$comment->date = new Doctrine_Expression('NOW()');
		
		$news->comments[] = $comment;
		$news->save();

		$this->_flashMessage('Комментарий сохранён!');
		$this->_backToNews();

	}

	/**
	 * render: false
	 * @return void
	 */
	public function delete()
	{

		$comment = $this->_db('NewsComment')->find($this->_request->id);
		$newsId = $comment->news->id;

		if (!$comment->canDelete($this->_user())) {
			$this->_flashMessage('Недостаточно прав!');
			$this->_backToNews($newsId);
			return;
		}

		$comment->delete();

		$this->_flashMessage('Комментарий удалён!');
		$this->_backToNews($newsId);
	}

	public function edit()
	{

		$comment = $this->_db('NewsComment')->find($this->_request->id);

		if (!$comment->canEdit($this->_user())) {
			$this->_flashMessage('Недостаточно прав!');
			$this->_backToNews($comment->news->id);
			return;
		}

		if ($this->_request->isPost()) {

			if (trim($this->_request->text) == '') {
				$this->_flashMessage('Вы не ввели текст!');
				$this->_backToNews($comment->news->id);
				return false;
			}

			$comment->text = $this->_request->text;
			$comment->save();

			$this->_flashMessage('Комментарий сохранён!');
			$this->_backToNews($comment->news->id);

		} else {
			$this->_response->comment = $comment;
		}

	}

}
