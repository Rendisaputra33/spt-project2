console.log(
	[
		{ i: 1, u: 2 },
		{ i: 2, u: 3 },
		{ i: 4, u: 5 },
		{ i: 6, u: 7 }
	].reduce((a, b) => {
		return a + b.i * b.u;
	}, 0)
);
