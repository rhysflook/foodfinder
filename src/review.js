import { getCode, generateReview } from './details.js';

(function () {
  const reviewBtn = document.getElementById('add-review');
  reviewBtn.addEventListener('click', () => {
    const newReview = createReview();
    const content = document.getElementById('review-content').value;
    const rating = document.querySelector('input[name="rating"]:checked').value;
    axios
      .post('./addReview.php', newReview(getCode(), content, rating))
      .then((res) => {
        const { user_name, rating, content } = res.data;
        const review = generateReview({
          author_name: user_name,
          rating,
          text: content,
        });

        const reviews = document.getElementById('site-reviews');
        reviews.appendChild(review);
        document.getElementById('review-area').remove();
      })
      .catch((err) => console.log(err));
  });
})();

export const createReview = () => {
  const user = localStorage.getItem('user');
  const name = localStorage.getItem('name');
  return (google_id, content, rating) => {
    return {
      user_id: user,
      user_name: name,
      google_id,
      content,
      date: Math.floor(Date.now() / 1000),
      rating,
    };
  };
};
