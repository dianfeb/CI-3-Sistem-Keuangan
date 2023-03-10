import 'package:flutter/material.dart';
// import 'package:english_world/english_world.dart';
import 'package:flutter/english_words.dart';
void main() => runApp(MyApp());

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    final wordPair = WordPair.random();
    return MaterialApp(
      title: 'Name Generator App',
      home: Scaffold(
        appBar: AppBar(
          title: const Text('Name Generator'),
        ),
        body: Center(
          child: Text(wordPair.asPascalCase),
        ),
      ),
    );
  }
}
