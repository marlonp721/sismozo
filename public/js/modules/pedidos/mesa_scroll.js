function scrollButtonClick(e) {
    var button = $(e.currentTarget);
    var scrollToLeft = button.find(".k-i-arrow-chevron-left").length !== 0;
    var scrollContainer = $(".k-card-deck").eq(0);
    var lastCard = scrollContainer.find(".k-card").last();
    var cardWidth = lastCard.outerWidth(true);


    if (scrollToLeft) {
        scrollContainer.scrollLeft(scrollContainer.scrollLeft() - cardWidth);
    } else {
        scrollContainer.scrollLeft(scrollContainer.scrollLeft() + cardWidth);
    }
};

$(document).ready(function () {
    var cardDeck = $(".k-card-deck-scrollwrap").eq(0);

    cardDeck.on("click", ".k-button-scroll", scrollButtonClick);
});