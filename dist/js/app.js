document.addEventListener('DOMContentLoaded', function(){
  const list = document.getElementById('donations-list');
  const stats = document.getElementById('stats-content');
  if(list){
    fetch('php/fetch_donations.php')
      .then(r=>r.json())
      .then(data=>{
        if(data.length===0){
          list.innerHTML = '<p>No donations available right now.</p>';
        } else {
          list.innerHTML = data.map(d => {
            return `<div class="form-card" style="margin-bottom:12px;">
              <strong>${escapeHtml(d.food_item)}</strong> — ${escapeHtml(d.quantity)}<br/>
              Expires: ${d.expiry_date} | Location: ${escapeHtml(d.location)}<br/>
              <form method="POST" action="php/claim.php" style="margin-top:8px;">
                <input type="hidden" name="donation_id" value="${d.id}" />
                <button class="btn" type="submit">Claim</button>
              </form>
            </div>`;
          }).join('');
        }
      })
      .catch(err=>{ list.innerHTML = '<p>Error loading donations.</p>'; console.error(err)});
  }

  if(stats){
    // basic stats: total available donations
    fetch('php/fetch_donations.php')
      .then(r=>r.json())
      .then(data=>{
        stats.innerHTML = '<p>Available donations: '+data.length+'</p>';
      });
  }

  function escapeHtml(str){ return String(str).replace(/[&<>\"]/g,function(m){return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[m]}); }
});