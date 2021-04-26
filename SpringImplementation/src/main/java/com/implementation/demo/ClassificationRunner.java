package com.implementation.demo;

import de.daslaboratorium.machinelearning.classifier.Classifier;
import de.daslaboratorium.machinelearning.classifier.bayes.BayesClassifier;

import java.util.Arrays;

public class ClassificationRunner {
    public String tag(String tag){
        final Classifier<String, String> bayes =
                new BayesClassifier<String, String>();


        final String[] infastructure = "Council Infrastructure Committee".split("\\s");
        bayes.learn("infrastructure", Arrays.asList(infastructure));
        final String[] youth = "Hayward Youth Commission".split("\\s");
        bayes.learn("youth/learning", Arrays.asList(youth));
        final String[] library = "Library Commission".split("\\s");
        bayes.learn("youth/learning", Arrays.asList(library));
        final String[] general = "City Council".split("\\s");
        bayes.learn("general", Arrays.asList(general));
        final String[] airports = "Airport Committee".split("\\s");
        bayes.learn("infrastructure",Arrays.asList(airports));



        final String[] unknownText1 =  tag.split("\\s");
        bayes.setMemoryCapacity(Integer.MAX_VALUE); // remember the last 500 learned classifications
        String classification = bayes.classify(Arrays.asList(unknownText1)).getCategory();
        bayes.setMemoryCapacity(Integer.MAX_VALUE); // remember the last 500 learned classifications

        return classification;



    }
}
